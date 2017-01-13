package com.jd.cf.demotion_sys;

import com.jd.cf.demotion_sys.domain.User;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-14
 * Time: 下午2:41
 * To change this template use File | Settings | File Templates.
 */
public interface UserDao {
    public int insertUser(User user);

    public int delUser(User user);

    public List<User> selectUser(User user);

    public int updateUser(User user);
}
