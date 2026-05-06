package tn.esprit.entities;

import java.sql.Timestamp;

public class Comment {
    private int id;
    private String content;
    private String authorEmail;
    private String authorName;
    private Timestamp createdAt;
    private int blogPostId;
    private Integer parentCommentId;

    public Comment() {}

    public Comment(int id, String content, String authorEmail, String authorName,
                   Timestamp createdAt, int blogPostId, Integer parentCommentId) {
        this.id = id;
        this.content = content;
        this.authorEmail = authorEmail;
        this.authorName = authorName;
        this.createdAt = createdAt;
        this.blogPostId = blogPostId;
        this.parentCommentId = parentCommentId;
    }

    public Comment(String content, String authorEmail, String authorName, int blogPostId) {
        this.content = content;
        this.authorEmail = authorEmail;
        this.authorName = authorName;
        this.blogPostId = blogPostId;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getContent() { return content; }
    public void setContent(String content) { this.content = content; }

    public String getAuthorEmail() { return authorEmail; }
    public void setAuthorEmail(String authorEmail) { this.authorEmail = authorEmail; }

    public String getAuthorName() { return authorName; }
    public void setAuthorName(String authorName) { this.authorName = authorName; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }

    public int getBlogPostId() { return blogPostId; }
    public void setBlogPostId(int blogPostId) { this.blogPostId = blogPostId; }

    public Integer getParentCommentId() { return parentCommentId; }
    public void setParentCommentId(Integer parentCommentId) { this.parentCommentId = parentCommentId; }

    @Override
    public String toString() {
        return "Comment{id=" + id + ", author='" + authorName + "', postId=" + blogPostId + "}";
    }
}
