import { Routes } from '@angular/router';
import { OwnersComponent } from './components/owners/owners.component';
import { FormOwnerComponent } from './components/form-owner/form-owner.component';
import { DetailOwnerComponent } from './components/detail-owner/detail-owner.component';
import { PetAddComponent } from './components/pet-add/pet-add.component';
import { VisitAddComponent } from './components/visit-add/visit-add.component';
import { VetsComponent } from './components/vets/vets.component';
import { VetAddComponent } from './components/vet-add/vet-add.component';

export const routes: Routes = [
    {path: "", component: OwnersComponent},
    {path: "form-owner/:id", component: FormOwnerComponent},
    {path: "detail-owner/:id", component: DetailOwnerComponent},
    {path: "pet-add/:idOwner/:id", component: PetAddComponent},
    {path: "visit-add/:idPet/:idOwner/:idVisit", component: VisitAddComponent},
    {path: "vets", component: VetsComponent},
    {path: "form-vet/:idVet", component: VetAddComponent}
];
