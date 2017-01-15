package com.vincent.dao;

import com.vincent.dao.mapper.SurveyMapper;
import com.vincent.entity.Survey;
import com.vincent.entity.SurveyExample;
import com.vincent.support.DBContextHolder;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Repository;

import javax.annotation.Resource;
import java.util.List;

/**
 * @author : weishen.xie
 * @version : 1.0.0
 * @since : 17/1/15 下午12:09
 */
@Repository("surveyDao")
public class SurveyDao {
    public static Logger logger = LoggerFactory.getLogger(SurveyDao.class);

    @Resource
    private SurveyMapper surveyMapper;

    public List<Survey> getAllSurveyList() {
        DBContextHolder.setDBType(DBContextHolder.RUC_DATA_SOURCE);
        SurveyExample example = new SurveyExample();
        example.createCriteria();
        example.setOrderByClause("create_time");
        List result = surveyMapper.selectByExample(example);
        return result;
    }

    public int addSurvey(Survey record) {
        DBContextHolder.setDBType(DBContextHolder.RUC_DATA_SOURCE);
        return surveyMapper.insert(record);
    }

    public int deleteSurvey(int id) {
        DBContextHolder.setDBType(DBContextHolder.RUC_DATA_SOURCE);
        return surveyMapper.deleteByPrimaryKey(id);
    }


}
