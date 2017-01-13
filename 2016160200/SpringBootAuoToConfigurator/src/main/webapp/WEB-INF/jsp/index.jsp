<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<%=request.getContextPath()%>/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
<link href="<%=request.getContextPath()%>/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="<%=request.getContextPath()%>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<%=request.getContextPath()%>/css/bootstrap.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<%=request.getContextPath()%>/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<%=request.getContextPath()%>/js/bootstrap.js"></script>

<script type="text/javascript">
	$(function(){
		$("#updateDept").on("click",function(){
			var selectedRow = [];
			var tr = $("#table>tbody>tr");
			$.each(tr,function(i,n){
				if($(this).children().eq(0).hasClass("selected")){
					$('#myModal').modal({
				        keyboard: true
				    })
					var deptNo = $(this).children().eq(0).text();
					var dName = $(this).children().eq(1).text();
					var loc = $(this).children().eq(2).text();
					$("input[name='deptNo']").val(deptNo);
					$("input[name='dName']").val(dName);
					$("input[name='loc']").val(loc);
					selectedRow.push(n);
				}
			})
			if(selectedRow.length<=0){
				alert("请选择一行！");
			}
		})
		
		$("#updateSubmit").on("click",function(){
			$("#updateForm").submit();
		});
		
		$("#insertDept").on("click",function(){
			$('#myModalInsert').modal({
		        keyboard: true
		    })
		});
		
		$("#insertSubmit").on("click",function(){
			$("#insertForm").submit();
		});
		
		$("#deleteDept").on("click",function(){
			var selectedRow = [];
			var tr = $("#table>tbody>tr");
			$.each(tr,function(i,n){
				if($(this).children().eq(0).hasClass("selected")){
					var deptNo = $(this).children().eq(0).text();
					$("#deleteDeptNo").val(deptNo);
					selectedRow.push(n);
				}
			})
			if(selectedRow.length<=0){
				alert("请选择一行！");
			}else{
				$("#deleteForm").submit();
			}
			
		})
		
		var selectedNum = 0;
		$("#table>tbody>tr").on("click",function(){
				if($(this).attr("class")!="selected"){
					$(this).css("background-color","#99CCFF");
					$(this).addClass("selected");
					$(this).children().eq(0).addClass("selected");	
				}else{
					$(this).css("background-color","#FFFFFF");
					$(this).removeClass("selected");
					$(this).children().eq(0).removeClass("selected");
				}
			})
		})
		
</script>

<title>test</title>
</head>
<body>
	<form role="form" action="/findDept"  method="post">
		<label for="name">编号:</label>
		<input type="text"  class="form-control" name="deptNo" placeholder="请输入名称"  />
		<input type="submit" value="查询" class="btn btn-primary"/>
		<input type="button" class="btn btn-primary" id="updateDept" value="修改">
		<input type="button" class="btn btn-primary" id="insertDept" value="新增">
		<input type="button" class="btn btn-primary" id="deleteDept" value="删除">
		
	</form>
	
	<form action="/deleteDept" id="deleteForm" method="post">
		<input type="hidden"  id="deleteDeptNo" name="deptNo" value="">
	</form>
	
	<table class="table table-condensed" id="table">
		<thead>
			<tr>
				<th>部门编号</th>
				<th>部门名称</th>
				<th>地址</th>
			</tr>
		</thead>
		<tbody>
		<c:forEach var="deptList" items="${deptList }">
			<tr>
				<td>${deptList.deptNo}</td>
				<td>${deptList.dName}</td>
				<td>${deptList.loc}</td>
			</tr>
			</c:forEach>
		</tbody>
	</table>
	
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">修改</h4>
            </div>
            <div class="modal-body">
            	<form action="/updateDept" method="post" id="updateForm">
            	<input type="hidden" name="deptNo" value=""/>
    			部门名称：<input type="text"  class="form-control" name="dName" placeholder="请输入部门名称" />
    			请输入部门简称：<input type="text"  class="form-control" name="loc" placeholder="请输入部门简称" />
    		</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="updateSubmit">提交更改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<div class="modal fade" id="myModalInsert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">新增</h4>
            </div>
            <div class="modal-body">
            	<form action="/insertDept" method="post" id="insertForm">
            	部门编号：<input type="text"  class="form-control" name="deptNo" placeholder="请输入部门编号" />
    			部门名称：<input type="text"  class="form-control" name="dName" placeholder="请输入部门名称" />
    			请输入部门简称：<input type="text"  class="form-control" name="loc" placeholder="请输入部门简称" />
    		</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="insertSubmit">保存</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
	
</body>
</html>