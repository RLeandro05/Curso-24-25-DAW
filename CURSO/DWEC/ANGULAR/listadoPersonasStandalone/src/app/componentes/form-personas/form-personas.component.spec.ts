import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormPersonasComponent } from './form-personas.component';

describe('FormPersonasComponent', () => {
  let component: FormPersonasComponent;
  let fixture: ComponentFixture<FormPersonasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FormPersonasComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FormPersonasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
