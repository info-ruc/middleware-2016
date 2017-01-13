package com.jd.cf.demotion_sys.service;

import com.jd.cf.demotion_sys.domain.Node;
import com.jd.cf.demotion_sys.domain.Plate;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-20
 * Time: 下午1:39
 * To change this template use File | Settings | File Templates.
 */
public interface PlateService {
    /**
     * 添加模块
     * @param plate
     * @return
     */
    public boolean insertPlate(Plate plate);

    /**
     * 修改模块
     * @param plate
     * @return
     */
    public boolean updatePlate(Plate plate);

    /**
     * 删除模块
     * @param plate
     * @return
     */
    public boolean delPlate(Plate plate);

    /**
     * 获取所有模块
     * @return
     */
    public List<Plate> selectPlateAll();
    /**
     * 获取对应模块
     * @return
     */
    public List<Plate> selectPlateById(Integer id);
}
