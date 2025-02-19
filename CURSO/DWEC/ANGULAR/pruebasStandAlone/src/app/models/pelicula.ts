import { Genero } from "./genero";

export interface Pelicula {
    id: number,
    nombre: string,
    fecha: Date | null,
    genero: Genero,
    sinopsis: string
}
