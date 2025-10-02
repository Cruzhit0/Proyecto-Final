<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TipoHabitacionModel;
use TCPDF;

class HabitacionesTipoController extends BaseController
{
    protected $tipoModel;

    public function __construct()
    {
        $this->tipoModel = new TipoHabitacionModel();
    }

    // LISTAR
    public function index()
    {
        $data = [
            'titulo' => 'Tipos de Habitación',
            'tipos'  => $this->tipoModel->orderBy('id', 'ASC')->findAll(),
            'usuario' => session()->get('nombre') ?? 'Administrador',
            'rol'     => session()->get('rol') ?? 'admin'
        ];

        return view('panel/habitacionesTipo/index', $data);
    }

    // CREAR - MOSTRAR FORMULARIO
    public function crear()
    {
        $data = [
            'titulo' => 'Nuevo Tipo de Habitación',
            'usuario' => session()->get('nombre') ?? 'Administrador',
            'rol'     => session()->get('rol') ?? 'admin'
        ];

        return view('panel/habitacionesTipo/crear', $data);
    }

    // CREAR - PROCESAR
    public function store()
    {
    // 🧪 DEPURACIÓN 1: Ver qué datos llegan del formulario (SIEMPRE SE PUEDE)
        $post = $this->request->getPost();
        log_message('info', '[DEBUG] Datos POST recibidos: ' . json_encode($post));

    // ➡️ SOLO DESPUÉS de validate() puedes usar $this->validator
        if (!$this->validate($this->tipoModel->validationRules)) {
        // 🧪 DEPURACIÓN 2: Ver errores de validación (YA ES SEGURO)
            $errors = $this->validator->getErrors();
            log_message('error', '[VALIDACIÓN FALLIDA] Errores: ' . json_encode($errors));

        // Mostrar errores en el formulario
            return redirect()->back()->withInput()->with('errors', $errors);
        }

    // ✅ Si pasó la validación, preparar datos
        $data = [
            'nombre'           => trim($this->request->getPost('nombre')),
            'descripcion'      => trim($this->request->getPost('descripcion')) ?: null,
            'capacidad_maxima' => (int) $this->request->getPost('capacidad_maxima'),
            'precio_noche'     => (float) $this->request->getPost('precio_noche'),
            'activo'           => $this->request->getPost('activo') ? 1 : 0
        ];

    // 🧪 DEPURACIÓN 3: Ver datos listos para insertar
        log_message('info', '[DEBUG] Datos listos para insertar: ' . json_encode($data));

        if ($this->tipoModel->insert($data)) {
            return redirect()->to('/panel/admin')->with('success', '✅ Tipo de habitación creado exitosamente.');
        } else {
        // 🧪 DEPURACIÓN 4: Ver errores del modelo
            $modelErrors = $this->tipoModel->errors();
            log_message('error', '[MODELO FALLÓ] Errores: ' . json_encode($modelErrors));

            return redirect()->back()->withInput()->with('error', '❌ Error al guardar en la base de datos. Contacte al administrador.');
        }
    }

    // EDITAR - MOSTRAR FORMULARIO
    public function editar($id = null)
    {
        $tipo = $this->tipoModel->find($id);

        if (!$tipo) {
            return redirect()->to('/panel/habitacionesTipo')->with('error', '❌ Tipo de habitación no encontrado.');
        }

        $data = [
            'titulo' => 'Editar Tipo de Habitación',
            'tipo'   => $tipo,
            'usuario' => session()->get('nombre') ?? 'Administrador',
            'rol'     => session()->get('rol') ?? 'admin'
        ];

        return view('panel/habitacionesTipo/editar', $data);
    }

    // EDITAR - PROCESAR
    public function update($id = null)
    {
        $tipo = $this->tipoModel->find($id);

        if (!$tipo) {
            return redirect()->to('/panel/habitacionesTipo')->with('error', '❌ Tipo no encontrado.');
        }

    // Modificar regla de unicidad para excluir el registro actual
        $rules = $this->tipoModel->validationRules;
        $rules['nombre']['rules'] = str_replace('{id}', $id, $rules['nombre']['rules']);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre'           => trim($this->request->getPost('nombre')),
            'descripcion'      => trim($this->request->getPost('descripcion')) ?: null,
            'capacidad_maxima' => (int) $this->request->getPost('capacidad_maxima'),
            'precio_noche'     => (float) $this->request->getPost('precio_noche'),
            'activo'           => $this->request->getPost('activo') ? 1 : 0
        ];

        if ($this->tipoModel->update($id, $data)) {
            return redirect()->to('/panel/admin')->with('success', '✅ Tipo de habitación actualizado exitosamente.');
        } else {
            log_message('error', '[UPDATE] Error al actualizar tipo ID ' . $id . ': ' . json_encode($this->tipoModel->errors()));
            return redirect()->back()->withInput()->with('error', '❌ Error interno al actualizar. Verifique los datos.');
        }
    }

    // DESACTIVAR
    public function eliminar($id = null)
    {
        $tipo = $this->tipoModel->find($id);

        if (!$tipo) {
            return redirect()->to('/panel/habitacionesTipo')->with('error', '❌ Tipo no encontrado.');
        }

        if ($this->tipoModel->update($id, ['activo' => 0])) {
            return redirect()->to('/panel/habitacionesTipo')->with('success', '✅ Tipo desactivado.');
        } else {
            log_message('error', 'Error al desactivar tipo ID ' . $id);
            return redirect()->to('/panel/habitacionesTipo')->with('error', '❌ Error al desactivar.');
        }
    }

    // ACTIVAR
    public function activar($id = null)
    {
        $tipo = $this->tipoModel->find($id);

        if (!$tipo) {
            return redirect()->to('/panel/habitacionesTipo')->with('error', '❌ Tipo no encontrado.');
        }

        if ($this->tipoModel->update($id, ['activo' => 1])) {
            return redirect()->to('/panel/habitacionesTipo')->with('success', '✅ Tipo activado.');
        } else {
            log_message('error', 'Error al activar tipo ID ' . $id);
            return redirect()->to('/panel/habitacionesTipo')->with('error', '❌ Error al activar.');
        }
    }

    // REPORTE PDF
    public function reporte()
    {
        $tipos = $this->tipoModel->orderBy('id', 'ASC')->findAll();

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Hotel Viña del Sur');
        $pdf->SetAuthor('Sistema Hotelero');
        $pdf->SetTitle('Reporte de Tipos de Habitación');
        $pdf->SetMargins(15, 20, 15);
        $pdf->SetAutoPageBreak(TRUE, 15);

        $pdf->AddPage();

        // Logo y título
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'HOTEL VIÑA DEL SUR', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Reporte de Tipos de Habitación', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
        $pdf->Ln(10);

        // Tabla
        $html = '
        <table border="1" cellpadding="6" style="border-collapse:collapse;">
        <thead>
        <tr style="background-color:#6D071A; color:white; font-weight:bold;">
        <th width="8%">ID</th>
        <th width="25%">Nombre</th>
        <th width="42%">Descripción</th>
        <th width="8%">Cap.</th>
        <th width="12%">Precio (BOB)</th>
        <th width="5%">Estado</th>
        </tr>
        </thead>
        <tbody>';

        foreach ($tipos as $tipo) {
            $estado = $tipo->activo ? 'Activo' : 'Inactivo';
            $color = $tipo->activo ? '#28a745' : '#dc3545';
            $html .= '<tr>
            <td align="center">' . $tipo->id . '</td>
            <td><strong>' . htmlspecialchars($tipo->nombre) . '</strong></td>
            <td>' . htmlspecialchars($tipo->descripcion ?? 'Sin descripción') . '</td>
            <td align="center">' . $tipo->capacidad_maxima . '</td>
            <td align="right">' . number_format($tipo->precio_noche, 2) . '</td>
            <td align="center" style="color:' . $color . '; font-weight:bold;">' . $estado . '</td>
            </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('tipos_habitacion_' . date('Ymd') . '.pdf', 'I');
        exit;
    }
}