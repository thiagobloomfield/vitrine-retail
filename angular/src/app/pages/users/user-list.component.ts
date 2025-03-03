import { Component, OnInit, inject } from '@angular/core';
import { NgFor, AsyncPipe } from '@angular/common';
import { MatListModule } from '@angular/material/list';
import { MatButtonModule } from '@angular/material/button';
import { UserService } from './user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-list',
  imports: [NgFor, AsyncPipe, MatListModule, MatButtonModule],
  templateUrl: './user-list.component.html',
  styleUrl: './user-list.component.scss',
  standalone: true,
})
export class UserListComponent {
  userService = inject(UserService);
  users$ = this.userService.getUsers();

  private router = inject(Router);

  ngOnInit(): void {}

  gotToEditUser(id: number): void {
    this.router.navigate([`/users/edit/${id}`]);
  }

  deleteUser(id: number): void {
    this.userService.deleteUser(id).subscribe(() => {
      this.users$ = this.userService.getUsers();
    });
  }
}
