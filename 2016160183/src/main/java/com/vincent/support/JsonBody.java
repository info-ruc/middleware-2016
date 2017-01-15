package com.vincent.support;

import java.lang.annotation.*;

/**
 * 用于标注Json或JSONP请求
 *
 * @author miao.yang susing@gmail.com
 * @since 2014-03-15
 */
@Target(ElementType.METHOD)
@Retention(RetentionPolicy.RUNTIME)
@Documented
public @interface JsonBody {

    /**
     * JSONP函数参数名
     *
     * @return
     */
    String callback() default "callback";

    String debugTag() default "debugTag";

    Version version() default Version.v2;

    JsonFeature[] enable() default {};

    JsonFeature[] disable() default {};

    public static enum Version{
        v1, v2
    }
}