package com.vincent.dao.mapper;

import com.vincent.entity.Survey;
import com.vincent.entity.SurveyExample;
import org.apache.ibatis.annotations.Param;

import java.util.List;

public interface SurveyMapper {
    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int countByExample(SurveyExample example);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int deleteByExample(SurveyExample example);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int insert(Survey record);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int insertSelective(Survey record);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    List<Survey> selectByExample(SurveyExample example);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    Survey selectByPrimaryKey(Integer id);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int updateByExampleSelective(@Param("record") Survey record, @Param("example") SurveyExample example);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int updateByExample(@Param("record") Survey record, @Param("example") SurveyExample example);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int updateByPrimaryKeySelective(Survey record);

    /**
     * This method was generated by MyBatis Generator.
     * This method corresponds to the database table survey
     *
     * @mbggenerated Thu Jan 12 21:41:36 CST 2017
     */
    int updateByPrimaryKey(Survey record);
}