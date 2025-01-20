import { TestBed } from '@angular/core/testing';

import { PAjaxService } from './p-ajax.service';

describe('PAjaxService', () => {
  let service: PAjaxService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PAjaxService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
