import { Routes } from '@angular/router';
import { OwnersComponent } from './components/owners/owners.component';
import { FormOwnerComponent } from './components/form-owner/form-owner.component';

export const routes: Routes = [
    {path: "", component: OwnersComponent},
    {path: "form-owner/:id", component: FormOwnerComponent}
];
