package com.jd.cf.demotion_sys.service;

import com.jd.cf.demotion_sys.domain.Node;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-18
 * Time: 上午10:33
 * To change this template use File | Settings | File Templates.
 */
public interface NodeService {
    /**
     * 添加贴
     * @param node
     * @return
     */
    public boolean insertNode(Node node);

    /**
     * 通过Id修改贴
     * @param node
     * @return
     */
    public boolean updateNodeById(Node node);

    /**
     * 删除贴
     * @param node
     * @return
     */
    public boolean delNode(Node node);
    /**
     * 查询贴
     * @param node
     * @return
     */
    public List<Node> selectNode(Node node);
}
