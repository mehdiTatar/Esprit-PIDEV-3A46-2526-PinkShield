package tn.esprit.entities;

import java.sql.Timestamp;

public class BlogPost {
    private int id;
    private String title;
    private String content;
    private String authorEmail;
    private String authorName;
    private String authorRole;
    private Timestamp createdAt;
    private String imagePath;

    public BlogPost() {}

    public BlogPost(int id, String title, String content, String authorEmail,
                    String authorName, String authorRole, Timestamp createdAt, String imagePath) {
        this.id = id;
        this.title = title;
        this.content = content;
        this.authorEmail = authorEmail;
        this.authorName = authorName;
        this.authorRole = authorRole;
        this.createdAt = createdAt;
        this.imagePath = imagePath;
    }

    public BlogPost(String title, String content, String authorEmail,
                    String authorName, String authorRole, String imagePath) {
        this.title = title;
        this.content = content;
        this.authorEmail = authorEmail;
        this.authorName = authorName;
        this.authorRole = authorRole;
        this.imagePath = imagePath;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getContent() { return content; }
    public void setContent(String content) { this.content = content; }

    public String getAuthorEmail() { return authorEmail; }
    public void setAuthorEmail(String authorEmail) { this.authorEmail = authorEmail; }

    public String getAuthorName() { return authorName; }
    public void setAuthorName(String authorName) { this.authorName = authorName; }

    public String getAuthorRole() { return authorRole; }
    public void setAuthorRole(String authorRole) { this.authorRole = authorRole; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }

    public String getImagePath() { return imagePath; }
    public void setImagePath(String imagePath) { this.imagePath = imagePath; }

    @Override
    public String toString() {
        return "BlogPost{id=" + id + ", title='" + title + "'}";
    }
}
