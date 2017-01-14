package com.jd.demotion.action;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import redis.clients.jedis.ShardedJedis;
import redis.clients.jedis.ShardedJedisPool;

import javax.annotation.Resource;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.Writer;
import java.net.URLDecoder;
import java.net.URLEncoder;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-18
 * Time: 下午2:52
 * To change this template use File | Settings | File Templates.
 */
public class BaseController  {
    private final static Logger logger = LoggerFactory.getLogger(BaseController.class);

    @Resource(name = "jedis")
    private ShardedJedisPool jedisSentinelPool;

    public static Cookie getCookie(HttpServletRequest request,String name){
        Cookie[] cookies=request.getCookies();
        if (cookies!=null && cookies.length>0){
            for(int i=0;i<cookies.length;i++){
                if (name.equalsIgnoreCase(cookies[i].getName())){
                    return cookies[i];
                }
            }
        }
        return null;
    }
    public static String getCookieValue(HttpServletRequest request,String name){
        Cookie cookie=getCookie(request,name);
        if (cookie!=null){
            String names= URLDecoder.decode(cookie.getValue());
            return names;
        }
        return null;
    }

    public static boolean stringBlank(String str){
        return str == null || str.length() == 0;
    }

    protected void writeJson(HttpServletResponse response,String msg)throws Exception{
        response.setCharacterEncoding("utf-8");
        response.setHeader("Content-Type", "application/json;charset=UTF-8");
        response.setContentType("application /json;charset=UTF-8");
        Writer writer = response.getWriter();
        writer.write(msg);
        writer.flush();
        writer.close();
    }
    public String findUserPin(HttpServletRequest request){
        ShardedJedis jedis= jedisSentinelPool.getResource();
        String pin=getCookieValue(request, "userName");
        try{
            pin=jedis.get("pin_"+pin);
        }catch (Exception e){
            logger.error("",e);
            pin=null;
        }
        return pin;
    }

}
