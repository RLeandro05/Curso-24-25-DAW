import { Specialtie } from "./specialtie";

export interface Vet {
    id: number,
    firstName: string,
    lastName: string,
    specialties: Specialtie[]
}
