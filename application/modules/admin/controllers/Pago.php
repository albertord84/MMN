<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends MY_Controller
{

    public function index()
    {
        $this->load->model('group_model');
        $group = $this->group_model->get(id_rol_cosumidor());

        $cobro_hijo = $group->cobro_hijo;
        $cobro_nieto = $group->cobro_nieto;

        $by = array(
            'active' => 1,
            'id <>' => 1
        );

        $this->load->model('user_model');
        $users = $this->user_model->get_many_by($by);

        foreach ($users as $user)
        {
            $recaudar = 0;
            $hijos = $this->user_model->get_hijos($user->id);

            foreach ($hijos as $hijo)
            {
                $nietos = $this->user_model->get_hijos($hijo->id, FALSE);

                foreach ($nietos as $nieto)
                {
                    if ($nieto->monthly_payment != 0)
                    {
                        $recaudar += $nieto->plan_amount * $cobro_nieto / 100 * $nieto->monthly_payment;
                    }
                }

                if (!empty($hijo->dumbu_id) && $hijo->monthly_payment != 0)
                {
                    $recaudar += $hijo->plan_amount * $cobro_hijo / 100 * $hijo->monthly_payment;
                }
            }

            // Proceso para pagar
            if ($recaudar > 0)
            {
                $year = date('Y');
                $month = date('m');

                $this->load->model('payment_model');
                if (!$this->payment_model->is_paid($user->id, $year, $month))
                {
                    $payment = array(
                        'id_user' => $user->id,
                        'amount' => $recaudar,
                        'paid_at' => date('Y-m-d H:i:s'),
                    );

                    if ($this->payment_model->register_payment($payment))
                    {
                        echo 'Payment Success for: ' . $user->email . '<br />';
                    }
                    else
                    {
                        echo 'Payment Error for: ' . $user->email . '<br />';
                    }
                }
                else
                {
                    echo 'Payment already done for: ' . $user->email . '<br />';
                }
            }
            else
            {
                echo 'Payment Amount  is 0 for: ' . $user->email . '<br />';
            }
        }


        /*
          $this->load->model('user_model');
          $raices = $this->user_model->get_raices();

          $recaudar = 0;
          foreach ($raices as $raiz)
          {
          $recaudar += $this->calcular_pago($raiz, $cobro_hijo, $cobro_nieto);
          }

          var_dump($recaudar);
         */
    }
    //ESTE PROCEDIMEINTO RECURSIVO ES OTRO MODO DE REALIZAR EL PAGO
    private function calcular_pago($nodo, $cobro_hijo, $cobro_nieto)
    {
        $hijos = $this->user_model->get_hijos($nodo->id);

        if (empty($hijos))
        {
            return 0;
        }

        foreach ($hijos as $hijo)
        {
            $nietos = $this->user_model->get_hijos($hijo->id, FALSE);

            foreach ($nietos as $nieto)
            {
                if ($nieto->monthly_payment != 0)
                {
                    $recaudar += $nieto->plan_amount * $cobro_nieto / 100 * $nieto->monthly_payment;
                }
            }

            if (!empty($hijo->dumbu_id) && $hijo->monthly_payment != 0)
            {
                $recaudar += $hijo->plan_amount * $cobro_hijo / 100 * $hijo->monthly_payment;
            }

            $recaudar += $this->calcular_pago($hijo, $cobro_hijo, $cobro_nieto);
        }
    }

}
