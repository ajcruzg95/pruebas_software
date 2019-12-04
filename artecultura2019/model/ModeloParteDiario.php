<?php

class ModeloParteDiario extends Modelo implements Operations {

    public function __construct() {
        parent::__construct();
    }


    public function getLista() {

        $sql = "SELECT `asistenciadocente`.`AistenciaDocenteFechaEntrada` as 'horaEntradaReal', 
            `asistenciadocente`.`AistenciaDocenteFechaSalida` as 'horaSalidaReal', 
            `curso`.`CursoNombre` as 'curso', 
            `docente`.`DocenteNombre` as 'docenteNombre',  
            `docente`.`DocenteApellido` as 'docenteApellido', 
            `grupo`.`GrupoNombre` as 'grupo',  
            `lugar`.`LugarNombre` as 'lugar',  
            `horario`.`HorarioEntrada`  as 'horaEntradaHorario',
            `horario`.`HorarioSalida`  as 'horaSalidaHorario'
            FROM `docente`
            LEFT JOIN `grupo` ON `grupo`.`IdDocente` = `docente`.`IdDocente`
            LEFT JOIN `curso` ON `grupo`.`IdCurso` = `curso`.`IdCurso`
            LEFT JOIN `horario` ON `horario`.`IdGrupo` = `grupo`.`IdGrupo`
            LEFT JOIN `lugar` ON `horario`.`IdLugar` = `lugar`.`IdLugar`
            LEFT JOIN `asistenciadocente` ON `asistenciadocente`.`IdGrupo` = `grupo`.`IdGrupo`
        ";
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);
    }

    public function getListaByDate($fecha, $dia) {
        $sql = "SELECT `asistenciadocente`.`AistenciaDocenteFechaEntrada` as 'horaEntradaReal', "
            ."`asistenciadocente`.`AistenciaDocenteFechaSalida` as 'horaSalidaReal', "
            ."`curso`.`CursoNombre` as 'curso', "
            ."`docente`.`DocenteNombre` as 'docenteNombre', "
            ."`docente`.`DocenteApellido` as 'docenteApellido', "
            ."`grupo`.`GrupoNombre` as 'grupo', "
            ."`lugar`.`LugarNombre` as 'lugar', " 
            ."`horario`.`HorarioEntrada`  as 'horaEntradaHorario',"
            ."`horario`.`HorarioSalida`  as 'horaSalidaHorario'"
            ."FROM `docente`"
            ."LEFT JOIN `grupo` ON `grupo`.`IdDocente` = `docente`.`IdDocente`"
            ."LEFT JOIN `curso` ON `grupo`.`IdCurso` = `curso`.`IdCurso`"
            ."LEFT JOIN `horario` ON `horario`.`IdGrupo` = `grupo`.`IdGrupo`"
            ."LEFT JOIN `lugar` ON `horario`.`IdLugar` = `lugar`.`IdLugar`"
            ."LEFT JOIN `asistenciadocente` ON `asistenciadocente`.`IdGrupo` = `grupo`.`IdGrupo`"
            ."LEFT JOIN `dia` ON `dia`.`IdDia` = `horario`.`IdDia`"
            ."WHERE DATE(`asistenciadocente`.`AistenciaDocenteFechaEntrada`) ='" .$fecha."'"
            ;
        ;
		
        // $arr = array('a' => $fecha, 'b' => $sql);
        //return json_encode($arr);
        
        $result = parent::getConn()->query($sql);
        $outp = array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($outp);

    }

    public function addRegistro($temp) {     
    }
    public function getRegistroPorId($id) {
    }

    public function delRegistroPorId($id) {
    }

    public function updRegistro($temp) {
    }

}
