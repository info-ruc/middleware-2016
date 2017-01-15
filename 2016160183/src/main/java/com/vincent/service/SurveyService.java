package com.vincent.service;

import com.vincent.dao.SurveyDao;
import com.vincent.entity.Survey;
import org.springframework.stereotype.Service;

import javax.annotation.Resource;
import java.util.List;

/**
 * @author : weishen.xie
 * @version : 1.0.0
 * @since : 17/1/15 下午12:05
 */
@Service
public class SurveyService {

    @Resource
    private SurveyDao surveyDao;

    /**
     * 返回所有投票
     *
     * @return
     */
    public List<Survey> getAllSurveyList() {
        List<Survey> surveyList = surveyDao.getAllSurveyList();
        return surveyList;
    }

    /**
     * 添加一条投票
     *
     * @param survey
     * @return
     */
    public int addSurvey(Survey survey) {
        return surveyDao.addSurvey(survey);
    }


    /**
     * 删除一条投票
     *
     * @param id
     * @return
     */
    public int deleteMonitorConfig(int id) {
        return surveyDao.deleteSurvey(id);
    }
}
