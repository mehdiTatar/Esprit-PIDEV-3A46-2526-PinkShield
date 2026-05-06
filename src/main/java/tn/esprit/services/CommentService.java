package tn.esprit.services;

import tn.esprit.entities.Comment;
import tn.esprit.tools.MyDatabase;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CommentService {
    private final Connection conn = MyDatabase.getInstance().getCnx();

    public int countAll() {
        String sql = "SELECT COUNT(*) FROM comment";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) { e.printStackTrace(); }
        return 0;
    }

    public int countRecent(int days) {
        String sql = "SELECT COUNT(*) FROM comment WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, days);
            ResultSet rs = ps.executeQuery();
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) { e.printStackTrace(); }
        return 0;
    }

    public int countPostsWithComments() {
        String sql = "SELECT COUNT(DISTINCT blog_post_id) FROM comment";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) { e.printStackTrace(); }
        return 0;
    }

    public java.util.Map<Integer, Integer> getCountsByPost() {
        java.util.Map<Integer, Integer> counts = new java.util.HashMap<>();
        String sql = "SELECT blog_post_id, COUNT(*) as cnt FROM comment GROUP BY blog_post_id";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) counts.put(rs.getInt("blog_post_id"), rs.getInt("cnt"));
        } catch (SQLException e) { e.printStackTrace(); }
        return counts;
    }

    public boolean add(Comment comment) {
        String sql = "INSERT INTO comment (content, author_email, author_name, created_at, blog_post_id, parent_comment_id) VALUES (?, ?, ?, NOW(), ?, ?)";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, comment.getContent());
            ps.setString(2, comment.getAuthorEmail());
            ps.setString(3, comment.getAuthorName());
            ps.setInt(4, comment.getBlogPostId());
            if (comment.getParentCommentId() != null)
                ps.setInt(5, comment.getParentCommentId());
            else
                ps.setNull(5, Types.INTEGER);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM comment WHERE id=?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<Comment> getByPostId(int postId) {
        List<Comment> comments = new ArrayList<>();
        String sql = "SELECT * FROM comment WHERE blog_post_id=? ORDER BY created_at ASC";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, postId);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) comments.add(mapRow(rs));
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return comments;
    }

    public List<Comment> getAll() {
        List<Comment> comments = new ArrayList<>();
        String sql = "SELECT * FROM comment ORDER BY created_at DESC";
        try (PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) comments.add(mapRow(rs));
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return comments;
    }

    private Comment mapRow(ResultSet rs) throws SQLException {
        Comment c = new Comment();
        c.setId(rs.getInt("id"));
        c.setContent(rs.getString("content"));
        c.setAuthorEmail(rs.getString("author_email"));
        c.setAuthorName(rs.getString("author_name"));
        c.setCreatedAt(rs.getTimestamp("created_at"));
        c.setBlogPostId(rs.getInt("blog_post_id"));
        int pid = rs.getInt("parent_comment_id");
        c.setParentCommentId(rs.wasNull() ? null : pid);
        return c;
    }
}
