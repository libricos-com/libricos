<?php
namespace App\Entity;
/**
 * BookAmazon class
 * 
 * Tomado de inc/samples/Factory_Static.php
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 * @see https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
 */
class BookAmazon extends Book
{
    
    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( \AAWP_Template_Handler $aawp )
    {
        parent::__construct($aawp);
        return $this->fill_aawp();
    }

    /**
     * Undocumented function
     * Fill all properties from an Amazon object template
     * 
     * @return void
     */
    protected function fill_aawp( ) 
    {
        $this->estado = $this->pod->field( 'estado' );
        // $this->asin = $product->get_product_id();
        // $this->is_prime = aawp_get_field_value($this->asin, 'prime');

        if(!$this->getReviews()){
            /*
            0 | Por leer
            1 | Siguiente
            2 | Leído
            3 | Leyendo
            4 | Cerrado
            5 | Pausado
            6 | No interesado
            7 | Cuarentena

            <a class="badge badge-success" href="<?php echo $urlReview;?>" data-toggle="tooltip" 
            title="Ficha del libro <?php echo $this2->post_title;?>">
                <i class="fas fa-check"></i>
                Reviewed
            </a> 
            */ 
            switch ($this->estado) {
                case '0':
                    $color = 'primary';
                    $icon_cls = 'book';
                    $txt = 'Por leer';
                    $tooltip = 'Añadido a la biblioteca';
                    break;
                case '1':
                    $color = 'warning';
                    $icon_cls = 'fire-alt';
                    $txt = 'Próximamente';
                    $tooltip = 'Se leerá en las próximas semanas';
                    break;
                case '2':
                    $color = 'primary';
                    $icon_cls = 'book';
                    $txt = 'Leído';
                    $tooltip = 'Leído en espera de review';
                    break;
                case '3':
                    $color = 'info';
                    $icon_cls = 'book-reader';
                    $txt = 'Leyendo ahora';
                    $tooltip = 'Actualmente leyendo';
                    break;
                case '4':
                    $color = 'secondary';
                    $icon_cls = 'book';
                    $txt = 'Cerrado';
                    $tooltip = 'Pausado para largo tiempo';
                    break;
                case '5':
                    $color = 'secondary';
                    $icon_cls = 'check';
                    $txt = 'Pausado';
                    $tooltip = 'Pausado por corto tiempo';
                    break;
                case '6':
                    $color = 'secondary';
                    $icon_cls = 'check';
                    $txt = 'No interesado';
                    $tooltip = 'No recomendable';
                    break;
                case '7':
                    $color = 'secondary';
                    $icon_cls = 'check';
                    $txt = 'Cuarentena';
                    $tooltip = 'Argumentos puestos en duda';
                    break;
                default:
                    # code...
                    break;
            }

            $this->estado = (object)[
                'color'     => $color,
                'url_libro' => $this->url,
                'tooltip'   => $tooltip,
                'icon_cls'  => $icon_cls,
                'txt'       => $txt,
                'value'     => $this->estado
            ];
        }
        return $this;
    }

}

