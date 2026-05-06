package tn.esprit.services;

import tn.esprit.entities.BlogPost;
import tn.esprit.tools.MyDatabase;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class BlogPostService {
    private final Connection conn = MyDatabase.getInstance().getCnx();

    public boolean add(BlogPost post) {
        String sql = "INSERT INTO blog_post (title, content, author_email, author_name, author_role, created_at, image_path) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, post.getTitle());
            ps.setString(2, post.getContent());
            ps.setString(3, post.getAuthorEmail());
            ps.setString(4, post.getAuthorName());
            ps.setString(5, post.getAuthorRole());
            if (post.getImagePath() != null && !post.getImagePath().isEmpty())
                ps.setString(6, post.getImagePath());
            else
                ps.setNull(6, Types.VARCHAR);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean update(BlogPost post) {
        String sql = "UPDATE blog_post SET title=?, content=?, author_email=?, author_name=?, author_role=?, image_path=? WHERE id=?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, post.getTitle());
            ps.setString(2, post.getContent());
            ps.setString(3, post.getAuthorEmail());
            ps.setString(4, post.getAuthorName());
            ps.setString(5, post.getAuthorRole());
            if (post.getImagePath() != null && !post.getImagePath().isEmpty())
                ps.setString(6, post.getImagePath());
            else
                ps.setNull(6, Types.VARCHAR);
            ps.setInt(7, post.getId());
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean delete(int id) {
        // Delete comments first to avoid FK constraint violation
        String deleteComments = "DELETE FROM comment WHERE blog_post_id=?";
        try (PreparedStatement ps = conn.prepareStatement(deleteComments)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        String sql = "DELETE FROM blog_post WHERE id=?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<BlogPost> getAll() {
        List<BlogPost> posts = new ArrayList<>();
        String sql = "SELECT * FROM blog_post ORDER BY created_at DESC";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) posts.add(mapRow(rs));
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return posts;
    }

    public BlogPost getById(int id) {
        String sql = "SELECT * FROM blog_post WHERE id=?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ResultSet rs = ps.executeQuery();
            if (rs.next()) return mapRow(rs);
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public int countAll() {
        String sql = "SELECT COUNT(*) FROM blog_post";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) { e.printStackTrace(); }
        return 0;
    }

    public int countRecent(int days) {
        String sql = "SELECT COUNT(*) FROM blog_post WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, days);
            ResultSet rs = ps.executeQuery();
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) { e.printStackTrace(); }
        return 0;
    }

    public java.util.Map<String, Integer> getRoleDistribution() {
        java.util.Map<String, Integer> dist = new java.util.LinkedHashMap<>();
        String sql = "SELECT LOWER(author_role) as role, COUNT(*) as cnt FROM blog_post GROUP BY LOWER(author_role) ORDER BY cnt DESC";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) dist.put(rs.getString("role"), rs.getInt("cnt"));
        } catch (SQLException e) { e.printStackTrace(); }
        return dist;
    }

    // Returns [authorName, count] or null if no posts
    public String[] getMostActiveAuthor() {
        String sql = "SELECT author_name, COUNT(*) as cnt FROM blog_post GROUP BY author_name ORDER BY cnt DESC LIMIT 1";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) return new String[]{ rs.getString("author_name"), String.valueOf(rs.getInt("cnt")) };
        } catch (SQLException e) { e.printStackTrace(); }
        return null;
    }

    public List<BlogPost> getTopByComments(int limit) {
        List<BlogPost> posts = new ArrayList<>();
        String sql = "SELECT b.* FROM blog_post b LEFT JOIN comment c ON b.id = c.blog_post_id " +
                     "GROUP BY b.id ORDER BY COUNT(c.id) DESC LIMIT ?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, limit);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) posts.add(mapRow(rs));
        } catch (SQLException e) { e.printStackTrace(); }
        return posts;
    }

    public List<BlogPost> search(String keyword) {
        List<BlogPost> posts = new ArrayList<>();
        String sql = "SELECT * FROM blog_post WHERE title LIKE ? OR content LIKE ? OR author_name LIKE ? ORDER BY created_at DESC";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            String kw = "%" + keyword + "%";
            ps.setString(1, kw);
            ps.setString(2, kw);
            ps.setString(3, kw);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) posts.add(mapRow(rs));
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return posts;
    }

    private BlogPost mapRow(ResultSet rs) throws SQLException {
        BlogPost p = new BlogPost();
        p.setId(rs.getInt("id"));
        p.setTitle(rs.getString("title"));
        p.setContent(rs.getString("content"));
        p.setAuthorEmail(rs.getString("author_email"));
        p.setAuthorName(rs.getString("author_name"));
        p.setAuthorRole(rs.getString("author_role"));
        p.setCreatedAt(rs.getTimestamp("created_at"));
        p.setImagePath(rs.getString("image_path"));
        return p;
    }
}
