package com.jd.demotion.action;

import com.google.gson.Gson;
import com.jd.cf.demotion_sys.domain.Comment;
import com.jd.cf.demotion_sys.domain.Node;
import com.jd.cf.demotion_sys.domain.Plate;
import com.jd.cf.demotion_sys.domain.User;
import com.jd.cf.demotion_sys.domain.com.jd.cf.demotion_sys.vo.CommentVo;
import com.jd.cf.demotion_sys.domain.com.jd.cf.demotion_sys.vo.NodeVo;
import com.jd.cf.demotion_sys.service.CommentService;
import com.jd.cf.demotion_sys.service.NodeService;
import com.jd.cf.demotion_sys.service.PlateService;
import com.jd.cf.demotion_sys.service.UserService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;
import redis.clients.jedis.Jedis;
import redis.clients.jedis.JedisSentinelPool;
import redis.clients.jedis.ShardedJedis;
import redis.clients.jedis.ShardedJedisPool;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.net.URLDecoder;
import java.net.URLEncoder;
import java.text.SimpleDateFormat;
import java.util.*;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-18
 * Time: 下午2:02
 * To change this template use File | Settings | File Templates.
 */
@Controller
public class NodeAction extends BaseController{
    private final static Logger logger = LoggerFactory.getLogger(NodeAction.class);

    @Resource(name = "nodeService")
    private NodeService nodeService;
    @Resource(name = "userService")
    private UserService userService;
    @Resource(name = "plateService")
    private PlateService plateService;
    @Resource(name = "commentService")
    private CommentService commentService;
    @Resource(name = "jedis")
    private ShardedJedisPool jedisSentinelPool;

    @RequestMapping("/school/insertNode.action")
    public ModelAndView insertNode(HttpServletRequest request, HttpServletResponse response,Node node){
        String nodeName=request.getParameter("nodeNames");
        node.setNodeName(nodeName);
        node.setImgUrl("/images/liezi1.jpg");
        ModelAndView model=new ModelAndView("/insertNode");
        String msg=null;
        if(node!=null){
            Gson gson=new Gson();
            logger.info("node:{}",gson.toJson(node));
            if(stringBlank(node.getNodeName())){
                msg="标题不能为空,请确定后提交";
            }
            if(stringBlank(node.getContent())){
                msg="内容不能为空，请确定后提交";
            }
            if(node.getParentId()==null){
                node.setParentId(0);
            }
            String pin=getCookieValue(request, "userName");
            ShardedJedis jedis= jedisSentinelPool.getResource();
            User user=new User();
            if(stringBlank(pin)){
                msg="请先登录，再发布信息！";
                user.setName(pin);
            }
            try{
                if(stringBlank(msg)){
                    if(!jedis.get("pin_"+pin).equals(pin)){
                        msg="请先登录，再发布信息！";
                    }
                    user.setName(pin);
                    List<User> users=userService.selectUser(user);
                    if(users!=null && users.size()>0){
                        node.setUserId(users.get(0).getId());
                    }
                    nodeService.insertNode(node);
                    msg="添加成功";
                    return new ModelAndView("redirect:http://www.schoolhome.com/index.html");
                }

            }catch (Exception e){
                logger.error("",e);
                msg="添加失败";
            }
        }
        logger.info("msg：{}",msg);
        model.addObject("msg", msg);
        List<Plate> plateList= plateService.selectPlateAll();
        model.addObject("plateListAll",plateList);
        String pin =findUserPin(request);
        logger.info("pin={}",pin);
        model.addObject("pin",pin);
        return model;
    }
    @RequestMapping("/school/insertNode.html")
    public ModelAndView insertNodeHtml(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=new ModelAndView("insertNode");
        List<Plate> plateList= plateService.selectPlateAll();
        model.addObject("plateListAll",plateList);
        String pin =findUserPin(request);
        logger.info("pin={}",pin);
        model.addObject("pin",pin);
        return model;
    }

    @RequestMapping("/school/updateNode.html")
    public ModelAndView updatetNode(HttpServletRequest request, HttpServletResponse response,Node node){
        ModelAndView model=new ModelAndView("node/update");
        String msg=null;
        if(node!=null){
            if(node.getNodeName()==null){
                msg="标题不能为空,请确定后提交";
            }
            if(node.getContent()==null){
                msg="内容不能为空，请确定后提交";
            }
            if(node.getParentId()==null){
                node.setParentId(0);
            }
            String pin=getCookieValue(request, "userName");
            if(stringBlank(pin)){
                msg="请先登录，再发布信息！";
            }
            User user=new User();
            user.setName(pin);
            ShardedJedis jedis= jedisSentinelPool.getResource();
            try{
                if(!jedis.get("pin_"+pin).equals(pin)){
                    msg="请先登录，再修改信息！";
                }else{
                    user.setName(pin);
                    List<User> users=userService.selectUser(user);
                    if(users!=null && users.size()>0){
                        node.setUserId(users.get(0).getId());
                    }
                    nodeService.updateNodeById(node);
                    msg="修改成功";
                }
            }catch (Exception e){
                logger.error("",e);
                msg="修改失败";
            }
        }
        model.addObject("msg",msg);
        return model;
    }
    @RequestMapping("/school/selectNode.action")
    public String selectNode(HttpServletRequest request, HttpServletResponse response,Node node){
        Map<String,Object> map=new HashMap<String, Object>();
        if(node!=null){
            List<Node> list=nodeService.selectNode(node);
            map.put("nodeList", list);
        }
        Gson gson=new Gson();
        String json=gson.toJson(map);
        try {
            writeJson(response,json);
        } catch (Exception e) {
            logger.error("",e);
        }
        return null;
    }
    @RequestMapping("/nodeDetails.html")
    public ModelAndView nodeDetails(HttpServletRequest request, HttpServletResponse response){
        String nodeId=request.getParameter("nodeId");
        ModelAndView model=null;
        Integer id=null;
        String msg=null;
        try{
            id=Integer.valueOf(nodeId);
        }catch (Exception e){
            logger.error("",e);
            msg="001";
        }
        if(stringBlank(msg)){
            Node node=new Node();
            node.setNodeId(id);
            List<Node> nodeList=nodeService.selectNode(node);
            if(nodeList!=null && nodeList.size()>0){
                Comment comment=new Comment();
                comment.setNodeId(id);
                List<Comment> list=commentService.selectComment(comment);
                model=new ModelAndView("node/nodeDetails");
                if(list!=null){
                    model.addObject("commentList",changeComment(list));
                }
                model.addObject("node",changVo(nodeList.get(0)));
                String pin =findUserPin(request);
                logger.info("pin={}",pin);
                model.addObject("pin",pin);
                List<Plate> plateList= plateService.selectPlateAll();
                model.addObject("plateListAll",plateList);
            }
        }
        return model;
    }
    @RequestMapping("/school/CommentsInsert.html")
    public ModelAndView commentsindsert(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=null;
        String content=request.getParameter("content");
        String plateSId=request.getParameter("plateId");
        String nodeSId=request.getParameter("nodeId");
        String msg=null;
        Integer plateId=null;
        Integer nodeId=null;
        try{
            plateId=Integer.valueOf(plateSId);
            nodeId=Integer.valueOf(nodeSId);
        }catch (Exception e){
            logger.error("",e);
            msg="信息有误";

        }
        if(stringBlank(msg)){
            String pin=findUserPin(request);
            User user=new User();
            user.setName(pin);
            List<User> userList=userService.selectUser(user);
            if(userList!=null && userList.size()>0){
                Comment comment=new Comment();
                comment.setContent(content);
                comment.setNodeId(nodeId);
                comment.setParentId(0);
                comment.setPlateId(plateId);
                comment.setUseId(userList.get(0).getId());
                comment.setCreateTime(new Date());
                 if(commentService.insertComment(comment)){
                     model=new ModelAndView("redirect:http://www.schoolhome.com/nodeDetails.html?nodeId="+nodeId);
                     return model;
                 }
            }
        }
        model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
        return model;
    }
    private NodeVo changVo(Node node){
        NodeVo nodeVo=new NodeVo();
        nodeVo.setNodeId(node.getNodeId());
        nodeVo.setNodeName(node.getNodeName());
        nodeVo.setContent(node.getContent());
        nodeVo.setParentId(node.getParentId());
        nodeVo.setType(node.getType());
        nodeVo.setImgUrl(node.getImgUrl());
        User user=new User();
        user.setId(node.getUserId());
        List<User> userList=userService.selectUser(user);
        if(userList!=null && userList.size()>0){
            nodeVo.setUserName(userList.get(0).getUserName());
        }
        List<Plate> plateList=plateService.selectPlateById(node.getPlateId());
        if(plateList!=null && plateList.size()>0){
            nodeVo.setPlateName(plateList.get(0).getName());
        }
        nodeVo.setPlateId(node.getPlateId());
        SimpleDateFormat time = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        nodeVo.setCreateTime(time.format(node.getCreateTime()));
        if (node.getUpdateTime()!=null){
            nodeVo.setUpdateTime(time.format(node.getUpdateTime()));
        }

        Comment comment=new Comment();
        comment.setNodeId(node.getNodeId());
        nodeVo.setCommentCount(commentService.selectCommentCount(comment));
        return nodeVo;
    }
    public List<CommentVo> changeComment(List<Comment> list){
        List<CommentVo> commentVoList=new ArrayList<CommentVo>();
        for(Comment comment:list){
            CommentVo commentVo=new CommentVo();
            commentVo.setId(comment.getId());
            commentVo.setContent(comment.getContent());
            SimpleDateFormat time = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
            commentVo.setCreateTime(time.format(comment.getCreateTime()));
            if(comment.getCreateTime()!=null){
                commentVo.setUpdateTime(time.format(comment.getUpdateTime()));
            }
            Comment commentP=new Comment();
            commentP.setId(comment.getParentId());
            List<Comment> commentPs=commentService.selectComment(commentP);
            if(commentPs!=null && commentPs.size()>0){
                commentVo.setParentComment(commentPs.get(0));
            }
            List<Plate> plates=plateService.selectPlateById(comment.getPlateId());
            if(plates!=null && plates.size()>0){
                commentVo.setPlate(plates.get(0));
            }
            User user=new User();
            user.setId(comment.getUseId());

            List<User> users=userService.selectUser(user);
            if (users!=null && users.size()>0){
                commentVo.setUser(users.get(0));
            }
            commentVoList.add(commentVo);
        }
        return commentVoList;
    }


}
