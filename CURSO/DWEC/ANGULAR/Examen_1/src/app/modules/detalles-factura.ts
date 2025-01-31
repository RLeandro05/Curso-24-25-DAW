export interface DetallesFactura {
    id: number;
    id_factura: number;
    cantidad: number;
    concepto: string;
    precio: number;
    tipo_iva: number;
    iva: number;
    total: number;
}
