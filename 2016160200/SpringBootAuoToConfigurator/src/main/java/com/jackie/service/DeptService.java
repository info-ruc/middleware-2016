package com.jackie.service;

import java.util.List;

import org.springframework.stereotype.Service;

import com.jackie.pojo.Dept;


public interface DeptService {
	
	
	public List<Dept> findAllDept();
	
	public List<Dept> findByDeptNo(String deptNo);
	
	public int insertDept(Dept dept);
	
	public int updateDeptByDeptNo(Dept dept);
	
	public int deleteDeptByDeptNo(String deptNo);
}
