import { Owner } from "./owner";

export interface Pet {
    id: number;
    name: string;
    birthDate: Date;
    type: any;
    //type: PetType;
    owner: Owner;
    visits: any[];
    //visits: Visit[];
}
