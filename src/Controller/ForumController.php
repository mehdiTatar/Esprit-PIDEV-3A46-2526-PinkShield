<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\ForumComment;
use App\Entity\Post;
use App\Entity\PostLike;
use App\Entity\User;
use App\Repository\ForumCommentRepository;
use App\Repository\PostLikeRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/forum')]
class ForumController extends AbstractController
{
    #[Route('/', name: 'forum_index', methods: ['GET'])]
    public function index(PostRepository $postRepository, PostLikeRepository $likeRepository): Response
    {
        $user = $this->getUser();
        [$actorId, $actorRole] = $user ? $this->actorIdentity($user) : [null, null];
        $likedPostIds = [];
        $posts = $postRepository->findLatest();

        if ($actorId && $actorRole) {
            $likedPostIds = $likeRepository->findPostIdsLikedByActor($posts, $actorId, $actorRole);
        }

        return $this->render('forum/index.html.twig', [
            'posts' => $posts,
            'likedPostIds' => $likedPostIds,
        ]);
    }

    #[Route('/new', name: 'forum_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, HttpClientInterface $httpClient): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        [$actorId, $actorRole, $actorName, $actorEmail] = $this->actorProfile($user);

        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('forum_new', (string) $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('Invalid forum form token.');
            }

            $title = trim((string) $request->request->get('title'));
            $content = trim((string) $request->request->get('content'));
            if ($this->containsProfanity($title.' '.$content, $httpClient)) {
                $this->addFlash('danger', 'Your content contains inappropriate language.');
                return $this->render('forum/new.html.twig');
            }

            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);
            $post->setAuthorId($actorId);
            $post->setAuthorRole($actorRole);
            $post->setAuthorName($actorName);
            $post->setAuthorEmail($actorEmail);
            $post->setIsDoctorPost($this->isGranted('ROLE_DOCTOR'));
            $post->setAllowComments(!$this->isGranted('ROLE_DOCTOR') || $request->request->getBoolean('allow_comments'));
            $imagePath = $this->handlePostImageUpload($request);
            if ($imagePath) {
                $post->setImagePath($imagePath);
            }

            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Forum post published.');
            return $this->redirectToRoute('forum_show', ['id' => $post->getId()]);
        }

        return $this->render('forum/new.html.twig');
    }

    #[Route('/{id}/edit', name: 'forum_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Post $post, Request $request, EntityManagerInterface $entityManager, HttpClientInterface $httpClient): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyUnlessPostOwner($post);

        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('forum_edit_'.$post->getId(), (string) $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('Invalid forum form token.');
            }

            $title = trim((string) $request->request->get('title'));
            $content = trim((string) $request->request->get('content'));
            if ($this->containsProfanity($title.' '.$content, $httpClient)) {
                $this->addFlash('danger', 'Your content contains inappropriate language.');
                return $this->render('forum/edit.html.twig', [
                    'post' => $post,
                ]);
            }

            $post->setTitle($title);
            $post->setContent($content);
            if ($this->isGranted('ROLE_DOCTOR')) {
                $post->setAllowComments($request->request->getBoolean('allow_comments'));
            }

            if ($request->request->getBoolean('remove_image')) {
                $this->deletePostImage($post);
                $post->setImagePath(null);
            }

            $imagePath = $this->handlePostImageUpload($request);
            if ($imagePath) {
                $this->deletePostImage($post);
                $post->setImagePath($imagePath);
            }

            $entityManager->flush();

            $this->addFlash('success', 'Forum post updated.');
            return $this->redirectToRoute('forum_show', ['id' => $post->getId()]);
        }

        return $this->render('forum/edit.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/delete', name: 'forum_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyUnlessPostOwner($post);

        if (!$this->isCsrfTokenValid('forum_delete_'.$post->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid delete token.');
        }

        $this->deletePostImage($post);
        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash('success', 'Forum post deleted.');
        return $this->redirectToRoute('forum_index');
    }

    #[Route('/{id}', name: 'forum_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Post $post, ForumCommentRepository $commentRepository, PostLikeRepository $likeRepository): Response
    {
        $user = $this->getUser();
        $liked = false;
        $canManage = false;
        if ($user) {
            [$actorId, $actorRole] = $this->actorIdentity($user);
            $liked = $likeRepository->findOneForActor($post, $actorId, $actorRole) !== null;
            $canManage = $this->isPostOwner($post, $actorId, $actorRole);
        }

        return $this->render('forum/show.html.twig', [
            'post' => $post,
            'comments' => $commentRepository->findThreadForPost($post),
            'liked' => $liked,
            'canManage' => $canManage,
        ]);
    }

    #[Route('/{id}/comment', name: 'forum_comment', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function comment(Post $post, Request $request, ForumCommentRepository $commentRepository, EntityManagerInterface $entityManager, HttpClientInterface $httpClient, MailerInterface $mailer): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if (!$post->allowsComments()) {
            $this->addFlash('danger', 'Comments are closed for this doctor post.');
            return $this->redirectToRoute('forum_show', ['id' => $post->getId()]);
        }

        if (!$this->isCsrfTokenValid('forum_comment_'.$post->getId(), (string) $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid comment form token.');
        }

        $user = $this->getUser();
        [$actorId, $actorRole, $actorName, $actorEmail] = $this->actorProfile($user);
        $content = trim((string) $request->request->get('content'));

        if ($content !== '') {
            if ($this->containsProfanity($content, $httpClient)) {
                $this->addFlash('danger', 'Your content contains inappropriate language.');
                return $this->redirectToRoute('forum_show', ['id' => $post->getId()]);
            }

            $comment = new ForumComment();
            $comment->setPost($post);
            $comment->setContent($content);
            $comment->setAuthorId($actorId);
            $comment->setAuthorRole($actorRole);
            $comment->setAuthorName($actorName);
            $comment->setAuthorEmail($actorEmail);

            $parentId = $request->request->get('parent_comment_id');
            if ($parentId) {
                $parent = $commentRepository->find((int) $parentId);
                if ($parent && $parent->getPost()?->getId() === $post->getId()) {
                    $comment->setParentComment($parent);
                }
            }

            $entityManager->persist($comment);
            $entityManager->flush();
            if ($this->sendPostCommentEmail($post, $mailer)) {
                $this->addFlash('success', 'Comment saved and email notification sent.');
            }
        }

        return $this->redirectToRoute('forum_show', ['id' => $post->getId()]);
    }

    #[Route('/{id}/like', name: 'forum_like', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function like(Post $post, Request $request, PostLikeRepository $likeRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if (!$this->isCsrfTokenValid('forum_like_'.$post->getId(), (string) $request->headers->get('X-CSRF-TOKEN'))) {
            return new JsonResponse(['error' => 'Invalid token'], Response::HTTP_FORBIDDEN);
        }

        [$actorId, $actorRole] = $this->actorIdentity($this->getUser());

        $like = $likeRepository->findOneForActor($post, $actorId, $actorRole);
        $liked = false;
        if ($like) {
            $entityManager->remove($like);
        } else {
            $like = new PostLike();
            $like->setPost($post);
            $like->setUserId($actorId);
            $like->setUserRole($actorRole);
            $entityManager->persist($like);
            $liked = true;
        }

        $entityManager->flush();

        return new JsonResponse([
            'liked' => $liked,
            'count' => $likeRepository->count(['post' => $post]),
        ]);
    }

    private function actorIdentity(UserInterface $user): array
    {
        return [$user->getId(), in_array('ROLE_DOCTOR', $user->getRoles(), true) ? 'ROLE_DOCTOR' : 'ROLE_USER'];
    }

    private function actorProfile(UserInterface $user): array
    {
        [$id, $role] = $this->actorIdentity($user);
        $name = $user->getUserIdentifier();

        if ($user instanceof User || $user instanceof Doctor) {
            $name = $user->getFullName() ?: $user->getUserIdentifier();
        }

        return [$id, $role, $name, $user->getUserIdentifier()];
    }

    private function isPostOwner(Post $post, int $actorId, string $actorRole): bool
    {
        return $post->getAuthorId() === $actorId && $post->getAuthorRole() === $actorRole;
    }

    private function denyUnlessPostOwner(Post $post): void
    {
        [$actorId, $actorRole] = $this->actorIdentity($this->getUser());
        if (!$this->isPostOwner($post, $actorId, $actorRole)) {
            throw $this->createAccessDeniedException('You can only manage your own forum posts.');
        }
    }

    private function handlePostImageUpload(Request $request): ?string
    {
        $image = $request->files->get('image');
        if (!$image instanceof UploadedFile || !$image->isValid()) {
            return null;
        }

        if (!str_starts_with((string) $image->getMimeType(), 'image/')) {
            $this->addFlash('danger', 'Please upload a valid image file.');
            return null;
        }

        if ($image->getSize() !== false && $image->getSize() > 5 * 1024 * 1024) {
            $this->addFlash('danger', 'Forum images must be smaller than 5 MB.');
            return null;
        }

        $uploadDir = $this->getParameter('kernel.project_dir').'/public/uploads/forum';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $slugger = new AsciiSlugger();
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = strtolower($slugger->slug($originalName ?: 'forum-image')->toString());
        $extension = $image->guessExtension() ?: $image->getClientOriginalExtension() ?: 'jpg';
        $fileName = $safeName.'-'.bin2hex(random_bytes(8)).'.'.$extension;

        try {
            $image->move($uploadDir, $fileName);
        } catch (FileException) {
            $this->addFlash('danger', 'The image could not be uploaded.');
            return null;
        }

        return 'uploads/forum/'.$fileName;
    }

    private function deletePostImage(Post $post): void
    {
        if (!$post->getImagePath()) {
            return;
        }

        $path = $this->getParameter('kernel.project_dir').'/public/'.$post->getImagePath();
        if (is_file($path)) {
            unlink($path);
        }
    }

    private function containsProfanity(string $text, HttpClientInterface $httpClient): bool
    {
        if (trim($text) === '') {
            return false;
        }

        try {
            $response = $httpClient->request('GET', 'https://www.purgomalum.com/service/containsprofanity', [
                'query' => ['text' => $text],
                'timeout' => 2.0,
                'max_duration' => 2.5,
            ]);

            return trim(strtolower($response->getContent(false))) === 'true';
        } catch (\Throwable) {
            return false;
        }
    }

    private function sendPostCommentEmail(Post $post, MailerInterface $mailer): bool
    {
        if (!$post->getAuthorEmail()) {
            return false;
        }

        $email = (new Email())
            ->from($this->getParameter('mailer_from'))
            ->to($post->getAuthorEmail())
            ->subject('New comment on your PinkShield forum post')
            ->text(sprintf(
                'Hello %s, someone just commented on your post: %s',
                $post->getAuthorName(),
                $post->getTitle()
            ))
            ->html(sprintf(
                '<p>Hello %s,</p><p>someone just commented on your post: <strong>%s</strong>.</p>',
                htmlspecialchars((string) $post->getAuthorName(), ENT_QUOTES, 'UTF-8'),
                htmlspecialchars((string) $post->getTitle(), ENT_QUOTES, 'UTF-8')
            ));

        try {
            $mailer->send($email);
            return true;
        } catch (\Throwable) {
            $this->addFlash('warning', 'Comment saved, but the email notification could not be sent.');
            return false;
        }
    }
}
