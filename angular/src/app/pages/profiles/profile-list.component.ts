import { Component, OnInit, inject } from '@angular/core';
import { NgFor, AsyncPipe } from '@angular/common';
import { ProfileService } from './profile.service';
import { Router } from '@angular/router';
import { MatListModule } from '@angular/material/list';
import { MatButtonModule } from '@angular/material/button';

@Component({
  selector: 'app-profile-list',
  standalone: true,
  imports: [NgFor, AsyncPipe, MatListModule, MatButtonModule],
  templateUrl: './profile-list.component.html',
  styleUrl: './profile-list.component.scss'
})
export class ProfileListComponent implements OnInit {
  private profileService = inject(ProfileService);
  private router = inject(Router);
  profiles$ = this.profileService.getProfiles();

  ngOnInit(): void {}

  editProfile(id: number): void {
    this.router.navigate([`/profiles/edit/${id}`]);
  }

  deleteProfile(id: number): void {
    this.profileService.deleteProfile(id).subscribe(() => {
      this.profiles$ = this.profileService.getProfiles();
    });
  }
}
