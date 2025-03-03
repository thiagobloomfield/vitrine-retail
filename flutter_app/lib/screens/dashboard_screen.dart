import 'package:flutter/material.dart';
import '../services/auth_service.dart';
import 'users_list_screen.dart';

class DashboardScreen extends StatelessWidget {
  final AuthService authService = AuthService();

  DashboardScreen({super.key});

  void logout(BuildContext context) async {
    await authService.logout();
    Navigator.pushReplacementNamed(context, '/');
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("Dashboard")),
      drawer: Drawer(
        child: ListView(
          children: [
            DrawerHeader(child: Text("Menu")),
            ListTile(title: Text("Usuários"), onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => UsersListScreen()))),
            // ListTile(title: Text("Perfis"), onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => ProfilesListScreen()))),
            ListTile(title: Text("Logout"), onTap: () => logout(context)),
          ],
        ),
      ),
      body: Center(child: Text("Bem-vindo ao Dashboard!")),
    );
  }
}
