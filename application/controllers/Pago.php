<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Pago extends MY_Controller
{

    public function index()
    {
        // obtener id se usuario logueado
        $user = $this->ion_auth->user()->row();
        $id_user = $user->id;

        $this->load->model('group_model');
        $group = $this->group_model->get(id_rol_cosumidor());

        $cobro_hijo = $group->cobro_hijo;
        $cobro_nieto = $group->cobro_nieto;

        $recaudar = 0;

        $this->load->model('user_model');
        $hijos = $this->user_model->get_hijos($id_user);

        $cant_hijos = count($hijos);
        $cant_hijos_pagantes = 0;

        $cant_nietos = 0;
        $cant_nietos_pagantes = 0;

        foreach ($hijos as $hijo)
        {
            $nietos = $this->user_model->get_hijos($hijo->id);

            foreach ($nietos as $nieto)
            {
                if (!empty($nieto->dumbu_id) && $nieto->monthly_payment != 0)
                {
                    $recaudar += $nieto->plan_amount * $cobro_nieto / 100 * $nieto->monthly_payment;
                    $cant_nietos_pagantes++;
                }
            }

            $cant_nietos += count($nietos);

            if (!empty($hijo->dumbu_id) && $hijo->monthly_payment != 0)
            {
                $recaudar += $hijo->plan_amount * $cobro_hijo / 100 * $hijo->monthly_payment;
                $cant_hijos_pagantes++;
            }
        }

        $this->mViewData['hijos'] = $cant_hijos;
        $this->mViewData['hijos_pagantes'] = $cant_hijos_pagantes;

        $this->mViewData['nietos'] = $cant_nietos;
        $this->mViewData['nietos_pagantes'] = $cant_nietos_pagantes;

        $this->mViewData['recaudar'] = $recaudar;
        $this->render('pago', 'full_width');
    }

}
