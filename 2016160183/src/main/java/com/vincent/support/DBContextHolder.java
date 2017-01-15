package com.vincent.support;

public class DBContextHolder {

    // 保证线程间不受影响
    private static final ThreadLocal<String> contextHolder = new ThreadLocal<String>();
    public static final String RUC_DATA_SOURCE = "rucDataSource";

    public static void clearDBType() {
        DBContextHolder.contextHolder.remove();
    }

    public static String getDBType() {
        return DBContextHolder.contextHolder.get();
    }

    public static void setDBType(String dbType) {
        DBContextHolder.contextHolder.set(dbType);
    }
}