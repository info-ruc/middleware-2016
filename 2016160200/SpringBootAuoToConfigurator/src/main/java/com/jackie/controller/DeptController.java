package com.jackie.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.jackie.annotationMapper.DeptMapper;
import com.jackie.pojo.Dept;
import com.jackie.service.DeptService;

@Controller
public class DeptController {
	
	public static final String INDEX = "index";
	
	@Autowired
	private DeptService service;
	
	@Autowired
//	private Dept dept;
	

	@RequestMapping("/")
	public String index(){
		return INDEX;
	}
	
	@RequestMapping(value = "/findDept")
	public String findDept(String deptNo,Model model){
		List<Dept> deptList= service.findByDeptNo(deptNo);
		model.addAttribute("deptList", deptList);
//		System.out.println(dept.toString());
		return INDEX;
	}
	
	@RequestMapping(value="/updateDept")
	public String updateDept(Dept dept,Model model){
		service.updateDeptByDeptNo(dept);
		List<Dept> deptList = service.findByDeptNo(dept.getDeptNo());
		model.addAttribute("deptList", deptList);
		return INDEX;
	}
	
	@RequestMapping(value="/insertDept")
	public String insertDept(Dept dept,Model model){
		service.insertDept(dept);
		List<Dept> deptList = service.findByDeptNo(dept.getDeptNo());
		model.addAttribute("deptList", deptList);
		return INDEX;
	}
	
	@RequestMapping(value="/deleteDept")
	public String deleteDept(Dept dept,Model model){
		service.deleteDeptByDeptNo(dept.getDeptNo());
		List<Dept> deptList = service.findAllDept();
		model.addAttribute("deptList", deptList);
		return INDEX;
	}
	
	
	
}
