package com.jackie.annotationMapper;

import java.util.List;
 
import org.apache.ibatis.annotations.Delete;
import org.apache.ibatis.annotations.Insert;
import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Select;
import org.apache.ibatis.annotations.SelectProvider;
import org.apache.ibatis.annotations.Update;

import com.jackie.pojo.Dept;
import com.jackie.sql.GetSql;

@Mapper
public interface DeptMapper {
	
	@Select("select * from dept t ")
	public List<Dept> findAllDept();
	
//	@Select("select * from dept t where t.deptNo = #{deptNo}")
	@SelectProvider(type=GetSql.class,method="findDept")
	public List<Dept> findByDeptNo(String deptNo);
	
	@Insert("insert into dept (deptNo, dName, LOC) values (#{deptNo}, #{dName}, #{loc})")
	public int insertDeptNo(Dept dept);
	
	@Update("update dept set dName = #{dName}, loc = #{loc} where deptNo = #{deptNo}")  
	public int updateDeptByDeptNo(Dept dept);
	
	@Delete("delete from dept where deptNo = #{deptNo}")
	public int deleteDeptByDeptNo(String deptNo);
}
