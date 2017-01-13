package com.jd.cf.demotion_sys.domain;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-4-21
 * Time: 下午8:43
 * To change this template use File | Settings | File Templates.
 */
public class User {
    private Integer Id;

    private String name;

    private String userName;

    private String password;

    private String modile;

    private String address;

    private String email;

    public Integer getId() {
        return Id;
    }

    public void setId(Integer id) {
        this.Id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getModile() {
        return modile;
    }

    public void setModile(String modile) {
        this.modile = modile;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }
}
