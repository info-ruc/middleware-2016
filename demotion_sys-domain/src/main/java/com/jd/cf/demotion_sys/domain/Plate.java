package com.jd.cf.demotion_sys.domain;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-20
 * Time: 上午11:22
 * To change this template use File | Settings | File Templates.
 */
public class Plate {
    private Integer Id;

    private String name;

    private String content;

    private String imgUrl;

    public String getImgUrl() {
        return imgUrl;
    }

    public void setImgUrl(String imgUrl) {
        this.imgUrl = imgUrl;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

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
}
