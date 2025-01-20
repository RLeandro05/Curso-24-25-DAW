import { ComponentFixture, TestBed } from '@angular/core/testing';

import { OtroComponent } from './otro.component';

describe('OtroComponent', () => {
  let component: OtroComponent;
  let fixture: ComponentFixture<OtroComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [OtroComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(OtroComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
