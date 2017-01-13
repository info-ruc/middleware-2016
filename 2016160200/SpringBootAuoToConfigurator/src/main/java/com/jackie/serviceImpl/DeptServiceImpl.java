package com.jackie.serviceImpl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.jackie.annotationMapper.DeptMapper;
import com.jackie.pojo.Dept;
import com.jackie.service.DeptService;
@Service
public class DeptServiceImpl implements DeptService{
	
	@Autowired
	private DeptMapper deptMapper; 
	
	@Override
	public List<Dept> findAllDept() {
		return deptMapper.findAllDept();
	}

	@Override
	public List<Dept> findByDeptNo(String deptNo) {
		return deptMapper.findByDeptNo(deptNo);
	}

	@Override
	public int insertDept(Dept dept) {
		return deptMapper.insertDeptNo(dept);
	}

	@Override
	public int updateDeptByDeptNo(Dept dept) {
		return deptMapper.updateDeptByDeptNo(dept);
	}

	@Override
	public int deleteDeptByDeptNo(String deptNo) {
		return deptMapper.deleteDeptByDeptNo(deptNo);
	}

}
