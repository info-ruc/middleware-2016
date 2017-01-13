package com.jd.cf.demotion_sys;

import com.jd.cf.demotion_sys.domain.Plate;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-20
 * Time: 上午11:28
 * To change this template use File | Settings | File Templates.
 */
public interface PlateDao {
    public int insertPlate(Plate plate);
    public int updatePlate(Plate plate);
    public int delPlate(Plate plate);
    public List<Plate> selectPlate(Plate plate);
}
