package com.jd.cf.demotion_sys.service.impl;

import com.jd.cf.demotion_sys.UserDao;
import com.jd.cf.demotion_sys.domain.User;
import com.jd.cf.demotion_sys.service.UserService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-18
 * Time: 下午1:49
 * To change this template use File | Settings | File Templates.
 */
public class UserServiceImpl implements UserService{

    private final static Logger logger	= LoggerFactory.getLogger(UserServiceImpl.class);

    private UserDao userDao;

    @Override
    public boolean insertUser(User user) {
       try{
           userDao.insertUser(user);
       }catch (Exception e){
           logger.error("",e);
           return false;
       }
        return true;
    }

    @Override
    public boolean updateUserById(User user) {
        try{
            userDao.updateUser(user);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public boolean delUser(User user) {
        try{
            userDao.delUser(user);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public List<User> selectUser(User user) {
        List<User> list=null;
        try{
            list=userDao.selectUser(user);
        }catch (Exception e){
            logger.error("",e);
            return null;
        }
        return list;
    }

    public UserDao getUserDao() {
        return userDao;
    }

    public void setUserDao(UserDao userDao) {
        this.userDao = userDao;
    }
}
