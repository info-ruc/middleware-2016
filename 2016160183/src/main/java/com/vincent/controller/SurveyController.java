package com.vincent.controller;

import com.vincent.entity.Survey;
import com.vincent.service.SurveyService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.servlet.ModelAndView;

import javax.annotation.Resource;
import java.util.List;

/**
 * @author : weishen.xie
 * @version : 1.0.0
 * @since : 17/1/12 下午9:51
 */

@Controller
@RequestMapping("/survey")
public class SurveyController {
    private static final Logger LOGGER = LoggerFactory.getLogger(SurveyController.class);

    @Resource
    private SurveyService surveyService;

    @RequestMapping("doSurvey")
    public ModelAndView index() {
        ModelAndView mv = new ModelAndView("home");
        return mv;
    }

    @RequestMapping("list")
    public ModelAndView surveyList() {
        List<Survey> surveyList = surveyService.getAllSurveyList();
        ModelAndView mv = new ModelAndView("surveyList");
        mv.addObject("surveyList", surveyList);
        return mv;
    }

    @ResponseBody
    @RequestMapping("/addSurvey.do")
    public String addConfig(Survey survey) {
        LOGGER.error("aabbcc: " + survey.getMode() + ", " + survey.getCreateTime()  + ", " + survey.getTopic());
        int res = surveyService.addSurvey(survey);
        if (res == 1) {
            return "Success!";
        } else {
            return "Failed!" ;
        }
    }

    @ResponseBody
    @RequestMapping("/deleteSurvey")
    public String deleteConfig(int id) {
        int res = surveyService.deleteMonitorConfig(id);
        if (res == 1) {
            return "Success！";
        } else {
            return "Failed! ";
        }
    }
}
