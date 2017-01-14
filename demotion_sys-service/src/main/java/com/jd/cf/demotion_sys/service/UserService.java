package com.jd.cf.demotion_sys.service;

import com.jd.cf.demotion_sys.domain.User;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-18
 * Time: 下午1:41
 * To change this template use File | Settings | File Templates.
 */
public interface UserService {
    /**
     * 保存用户
     * @param user
     * @return
     */
    public boolean insertUser(User user);
    /**
     * 修改用户
     * @param user
     * @return
     */
    public boolean updateUserById(User user);
    /**
     * 删除用户
     * @param user
     * @return
     */
    public boolean delUser(User user);

    /**
     * 查询用户
     * @param user
     * @return
     */
    public List<User> selectUser(User user);
}
