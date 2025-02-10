import { Owner } from "./owner";
import { Pettype } from "./pettype";
import { Visit } from "./visit";

export interface Pet {
    id: number;
    name: string;
    birthDate: Date | null;
    //type: any;
    type: Pettype;
    typeName?: string;
    owner: Owner;
    //visits: any[];
    visits: Visit[];
}
