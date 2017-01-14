package com.jd.cf.demotion_sys.service.impl;

import com.jd.cf.demotion_sys.CommentDao;
import com.jd.cf.demotion_sys.NodeDao;
import com.jd.cf.demotion_sys.domain.Comment;
import com.jd.cf.demotion_sys.service.CommentService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-6-2
 * Time: 下午2:13
 * To change this template use File | Settings | File Templates.
 */
public class CommentServiceImpl implements CommentService {
    private final static Logger logger	= LoggerFactory.getLogger(CommentServiceImpl.class);

    private CommentDao commentDao;

    @Override
    public boolean insertComment(Comment comment) {
        try{
            commentDao.insertComment(comment);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public boolean updateComment(Comment comment) {
        try{
            commentDao.updateComment(comment);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public boolean delComment(Comment comment) {
        try{
            commentDao.delComment(comment);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public List<Comment> selectComment(Comment comment) {
       List<Comment> list=null;
       try{
           list=commentDao.selectComment(comment);
       }catch (Exception e){
           logger.error("",e);
           return null;
       }
        return list;
    }

    @Override
    public Integer selectCommentCount(Comment comment) {
        Integer count=null;
        try{
            count=commentDao.selectCommentCount(comment);
        }catch (Exception e){
            logger.error("",e);
            return null;
        }
        return  count;
    }

    public CommentDao getCommentDao() {
        return commentDao;
    }

    public void setCommentDao(CommentDao commentDao) {
        this.commentDao = commentDao;
    }
}
