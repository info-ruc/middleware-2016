package com.jd.cf.demotion_sys;

import com.jd.cf.demotion_sys.domain.Node;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-14
 * Time: 下午1:50
 * To change this template use File | Settings | File Templates.
 */
public interface NodeDao {
    public int insertNode(Node node);
    public int updateNode(Node node);
    public int delNode(Node node);
    public List<Node> selectNode(Node node);
}
