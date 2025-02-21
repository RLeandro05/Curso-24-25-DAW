import { Carta } from "./carta"
import { Zona } from "./zona"

export interface Local {
    id: number,
    nombre: string,
    id_zona: number,
    zona: string,
    telefono: string,
    direccion: string,
    observaciones: string,
    carta: Carta[]
}
