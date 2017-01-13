package com.jd.cf.demotion_sys.service;

import com.jd.cf.demotion_sys.domain.Comment;
import com.jd.cf.demotion_sys.domain.Plate;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-6-2
 * Time: 上午10:32
 * To change this template use File | Settings | File Templates.
 */
public interface CommentService {
    /**
     * 添加评论
     * @param comment
     * @return
     */
    public boolean insertComment(Comment comment);

    /**
     * 修改评论
     * @param comment
     * @return
     */
    public boolean updateComment(Comment comment);

    /**
     * 删除评论
     * @param comment
     * @return
     */
    public boolean delComment(Comment comment);

    /**
     * 获取对应的评论
     * @param comment
     * @return
     */
    public List<Comment> selectComment(Comment comment);
    /**
     * 获取评论数
     * @param comment
     * @return
     */
    public Integer selectCommentCount(Comment comment);
}
