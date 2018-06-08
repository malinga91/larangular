import { TestBed, inject } from '@angular/core/testing';

import { FacebookServiceService } from './facebook-service.service';

describe('FacebookServiceService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [FacebookServiceService]
    });
  });

  it('should be created', inject([FacebookServiceService], (service: FacebookServiceService) => {
    expect(service).toBeTruthy();
  }));
});
