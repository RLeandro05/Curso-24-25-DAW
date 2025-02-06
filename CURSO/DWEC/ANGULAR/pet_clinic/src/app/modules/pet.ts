import { Owner } from "./owner";

export interface Pet {
    id: number;
    name: string;
    birthDate: Date | null;
    type: any;
    //type: PetType;
    owner: Owner;
    visits: any[];
    //visits: Visit[];
}
