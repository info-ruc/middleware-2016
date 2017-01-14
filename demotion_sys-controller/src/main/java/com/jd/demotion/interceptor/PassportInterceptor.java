package com.jd.demotion.interceptor;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.web.servlet.handler.HandlerInterceptorAdapter;
import redis.clients.jedis.ShardedJedis;
import redis.clients.jedis.ShardedJedisPool;

import javax.annotation.Resource;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-27
 * Time: 下午6:00
 * To change this template use File | Settings | File Templates.
 */
public class PassportInterceptor extends HandlerInterceptorAdapter {
    private final static Logger logger = LoggerFactory.getLogger(PassportInterceptor.class);

    @Resource(name = "jedis")
    private ShardedJedisPool jedisSentinelPool;

    public boolean preHandle(HttpServletRequest request, HttpServletResponse response, Object handler)
            throws Exception {
        String pin=getCookieValue(request, "userName");
        ShardedJedis jedis= jedisSentinelPool.getResource();
        if(jedis!=null && jedis.get("pin_"+pin)!=null ){
            if(jedis.get("pin_"+pin).equals(pin)){
                   return true;
            }
        }
        response.sendRedirect("http://www.schoolhome.com/login.html?returnUrl="+ getBackUrl(request));
        return false;
    }

    private String getBackUrl( HttpServletRequest request ){
        String backurl="http://" + request.getServerName() +  request.getContextPath() + request.getServletPath();
        try {
            backurl= URLEncoder.encode(backurl, "utf-8");
        } catch (UnsupportedEncodingException e) {
            logger.error("",e);
        }
        logger.info("backUrl:" + backurl);
        return backurl;
    }
    public static String getCookieValue(HttpServletRequest request,String name){
        Cookie cookie=getCookie(request,name);
        if (cookie!=null){
            return cookie.getValue();
        }
        return null;
    }
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
}
