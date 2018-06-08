import { TestBed, inject } from '@angular/core/testing';

import { AuthFbService } from './auth-fb.service';

describe('Auth.FbService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [AuthFbService]
    });
  });

  it('should be created', inject([AuthFbService], (service: AuthFbService) => {
    expect(service).toBeTruthy();
  }));
});
