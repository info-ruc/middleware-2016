package com.jd.cf.demotion_sys.domain.com.jd.cf.demotion_sys.vo;

import com.jd.cf.demotion_sys.domain.Comment;
import com.jd.cf.demotion_sys.domain.Node;
import com.jd.cf.demotion_sys.domain.Plate;
import com.jd.cf.demotion_sys.domain.User;

import java.util.Date;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-6-1
 * Time: 下午5:37
 * To change this template use File | Settings | File Templates.
 */
public class CommentVo {
    private Integer id;

    private String content;

    private User user;

    private Plate plate;

    private Node node;

    private String createTime;

    private String updateTime;

    private Comment parentComment;

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }

    public Plate getPlate() {
        return plate;
    }

    public void setPlate(Plate plate) {
        this.plate = plate;
    }

    public Node getNode() {
        return node;
    }

    public void setNode(Node node) {
        this.node = node;
    }

    public String getCreateTime() {
        return createTime;
    }

    public void setCreateTime(String createTime) {
        this.createTime = createTime;
    }

    public String getUpdateTime() {
        return updateTime;
    }

    public void setUpdateTime(String updateTime) {
        this.updateTime = updateTime;
    }

    public Comment getParentComment() {
        return parentComment;
    }

    public void setParentComment(Comment parentComment) {
        this.parentComment = parentComment;
    }
}
