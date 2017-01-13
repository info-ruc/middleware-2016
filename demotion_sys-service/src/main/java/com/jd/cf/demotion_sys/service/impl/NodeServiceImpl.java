package com.jd.cf.demotion_sys.service.impl;

import com.jd.cf.demotion_sys.NodeDao;
import com.jd.cf.demotion_sys.domain.Node;
import com.jd.cf.demotion_sys.service.NodeService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-18
 * Time: 上午11:20
 * To change this template use File | Settings | File Templates.
 */
public class NodeServiceImpl implements NodeService {
    private final static Logger logger	= LoggerFactory.getLogger(NodeServiceImpl.class);

    private NodeDao nodeDao;

    @Override
    public boolean insertNode(Node node) {
       try{
           nodeDao.insertNode(node);
       }catch (Exception e){
           logger.error("",e);
           return false;
       }
        return true;
    }

    @Override
    public boolean updateNodeById(Node node) {
        try{
            nodeDao.updateNode(node);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public boolean delNode(Node node) {
        try{
            nodeDao.delNode(node);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public List<Node> selectNode(Node node) {
        List<Node> list=null;
        try{
            list= nodeDao.selectNode(node);
        }catch (Exception e){
            logger.error("",e);
            return null;
        }
        return list;
    }
    public NodeDao getNodeDao() {
        return nodeDao;
    }

    public void setNodeDao(NodeDao nodeDao) {
        this.nodeDao = nodeDao;
    }

}
