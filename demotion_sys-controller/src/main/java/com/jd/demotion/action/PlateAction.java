package com.jd.demotion.action;

import com.jd.cf.demotion_sys.domain.Comment;
import com.jd.cf.demotion_sys.domain.Node;
import com.jd.cf.demotion_sys.domain.Plate;
import com.jd.cf.demotion_sys.domain.User;
import com.jd.cf.demotion_sys.domain.com.jd.cf.demotion_sys.vo.NodeVo;
import com.jd.cf.demotion_sys.service.CommentService;
import com.jd.cf.demotion_sys.service.NodeService;
import com.jd.cf.demotion_sys.service.PlateService;
import com.jd.cf.demotion_sys.service.UserService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-20
 * Time: 下午2:32
 * To change this template use File | Settings | File Templates.
 */
@Controller
public class PlateAction extends BaseController{
    private final static Logger logger = LoggerFactory.getLogger(PlateAction.class);
    @Resource(name = "nodeService")
    private NodeService nodeService;

    @Resource(name = "userService")
    private UserService userService;

    @Resource(name = "plateService")
    PlateService plateService;

    @Resource(name = "commentService")
    private CommentService commentService;

    @RequestMapping("/school/insertPlate.html")
    public ModelAndView insertPlate(HttpServletRequest request, HttpServletResponse response,Plate plate){
        ModelAndView model=null;
        String msg=null;
        if(stringBlank(plate.getName())){
            msg="请输入模块名";
        }
        if(stringBlank(msg)){
            try {
                plateService.insertPlate(plate);
            }catch (Exception e){
                logger.error("",e);
                msg="添加失败";
                model=new ModelAndView("insertPlate");
                model.addObject("msg",msg);
                return model;
            }
            model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
            return  model;
        }else{
            model=new ModelAndView("insertPlate");
            model.addObject("msg",msg);
            return model;
        }
    }
    @RequestMapping("/school/updatePlate.html")
    public ModelAndView updatePlate(HttpServletRequest request, HttpServletResponse response,Plate plate){
        ModelAndView model=null;
        String msg=null;
        if(stringBlank(plate.getName())){
            msg="请输入模块名";
        }
        if(stringBlank(msg)){
            try {
                plateService.updatePlate(plate);
            }catch (Exception e){
                logger.error("",e);
                msg="修改失败";
                model=new ModelAndView("insertPlate");
                model.addObject("msg",msg);
                return model;
            }
            model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
            return  model;
        }else{
            model=new ModelAndView("insertPlate");
            model.addObject("msg",msg);
            return model;
        }
    }
    @RequestMapping("/nodelist.html")
    public ModelAndView nodelistbyId(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=new ModelAndView("nodelist");
        String id=request.getParameter("id");
        String userId=request.getParameter("userId");
        Node node=new Node();
        if(!stringBlank(id)){
            node.setPlateId(Integer.valueOf(id));
        }
        if(!stringBlank(userId)){
            node.setUserId(Integer.valueOf(userId));
        }
        List<Node> nodeList=nodeService.selectNode(node);
        List<NodeVo> nodeVos= changeVoList(nodeList);
        model.addObject("nodeList",nodeVos);
        model.addObject("plateListAll",plateService.selectPlateAll());
        String pin =findUserPin(request);
        logger.info("pin={}",pin);
        model.addObject("pin",pin);
        return model;
    }

    private  List<NodeVo>  changeVoList( List<Node> nodeList){
        List<NodeVo> list=new ArrayList<NodeVo>();
        if(nodeList!=null){
            for(Node node:nodeList){
                list.add(changVo(node));
            }
        }
        return list;
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
        SimpleDateFormat time = new SimpleDateFormat("yyyy-MM-dd");
        nodeVo.setCreateTime(time.format(node.getCreateTime()));
        if (node.getUpdateTime()!=null){
            nodeVo.setUpdateTime(time.format(node.getUpdateTime()));
        }

        Comment comment=new Comment();
        comment.setNodeId(node.getNodeId());
        nodeVo.setCommentCount(commentService.selectCommentCount(comment));
        return nodeVo;
    }
}
