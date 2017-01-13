package com.jackie.sql;

import org.apache.ibatis.jdbc.SQL;


public class GetSql {
	
	public String findDept(final String deptNo){
		String sql = new SQL(){
			{
				SELECT("DEPTNO,DNAME,LOC");
				FROM("DEPT");
				if(deptNo!=null&&!"".equals(deptNo)){
					WHERE("deptNo="+deptNo);
				}
			}
		}.toString();
		return sql;
	}
		
}
