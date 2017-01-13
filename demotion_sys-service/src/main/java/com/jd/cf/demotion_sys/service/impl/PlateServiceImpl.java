package com.jd.cf.demotion_sys.service.impl;

import com.jd.cf.demotion_sys.PlateDao;
import com.jd.cf.demotion_sys.domain.Plate;
import com.jd.cf.demotion_sys.service.PlateService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-20
 * Time: 下午1:55
 * To change this template use File | Settings | File Templates.
 */
public class PlateServiceImpl implements PlateService {
    private final static Logger logger	= LoggerFactory.getLogger(PlateServiceImpl.class);

    private PlateDao plateDao;

    @Override
    public boolean insertPlate(Plate plate) {
        try{
            plateDao.insertPlate(plate);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public boolean updatePlate(Plate plate) {
        try{
            plateDao.updatePlate(plate);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public boolean delPlate(Plate plate) {
        try{
            plateDao.delPlate(plate);
        }catch (Exception e){
            logger.error("",e);
            return false;
        }
        return true;
    }

    @Override
    public List<Plate> selectPlateAll() {
        Plate plate=new Plate();
        List<Plate> list=null;
        try{
            list=plateDao.selectPlate(plate);
        }catch (Exception e){
            logger.error("",e);
            return null;
        }
        return list;
    }

    @Override
    public List<Plate> selectPlateById(Integer id) {
        Plate plate=new Plate();
        plate.setId(id);
        List<Plate> list=null;
        try{
            list=plateDao.selectPlate(plate);
        }catch (Exception e){
            logger.error("",e);
            return null;
        }
        return list;
    }

    public PlateDao getPlateDao() {
        return plateDao;
    }

    public void setPlateDao(PlateDao plateDao) {
        this.plateDao = plateDao;
    }
}
