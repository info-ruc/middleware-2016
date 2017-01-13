package com.jd.cf.demotion_sys;

import com.jd.cf.demotion_sys.domain.Comment;
import com.jd.cf.demotion_sys.domain.Node;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-6-1
 * Time: 下午5:40
 * To change this template use File | Settings | File Templates.
 */
public interface CommentDao {
    public int insertComment(Comment comment);
    public int updateComment(Comment comment);
    public int delComment(Comment comment);
    public List<Comment> selectComment(Comment comment);
    public  Integer selectCommentCount(Comment comment);
}
